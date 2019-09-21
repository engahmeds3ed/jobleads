<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfterTaxesInsertTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
CREATE TRIGGER after_taxes_insert
    AFTER INSERT ON taxes
    FOR EACH ROW
    BEGIN
	    UPDATE states INNER JOIN (
			SELECT SUM(taxes.amount) AS taxes_amount, counties.state_id FROM taxes
			INNER JOIN counties ON taxes.county_id = counties.id
			WHERE counties.id = NEW.county_id
			GROUP BY counties.state_id
		) innerSelect ON states.id = innerSelect.state_id
		SET states.taxes_amount = innerSelect.taxes_amount;
		
		UPDATE states INNER JOIN (
			SELECT AVG(taxes.amount) AS taxes_amount_avg, counties.state_id FROM taxes
			INNER JOIN counties ON taxes.county_id = counties.id
			WHERE counties.id = NEW.county_id
			GROUP BY counties.state_id
		) innerSelect ON states.id = innerSelect.state_id
		SET states.taxes_amount_avg = innerSelect.taxes_amount_avg;
	
		UPDATE counties INNER JOIN (
			SELECT AVG(taxrates.amount) AS taxrates_avg, states.country_id FROM taxes
			INNER JOIN counties ON taxes.county_id = counties.id
			INNER JOIN taxrates ON taxes.taxrate_id = taxrates.id
			WHERE counties.id = NEW.county_id
			GROUP BY counties.id
		) innerSelect ON counties.id = innerSelect.county_id
		SET counties.taxrates_avg = innerSelect.taxrates_avg;
		
		UPDATE countries INNER JOIN (
			SELECT AVG(taxrates.amount) AS taxrates_avg, states.country_id FROM taxes
			INNER JOIN counties ON taxes.county_id = counties.id
			INNER JOIN states ON counties.state_id = states.id
			INNER JOIN taxrates ON taxes.taxrate_id = taxrates.id
			WHERE counties.id = NEW.county_id
			GROUP BY states.country_id
		) innerSelect ON countries.id = innerSelect.country_id
		SET countries.taxrates_avg = innerSelect.taxrates_avg;
	
		UPDATE countries INNER JOIN (
			SELECT SUM(taxes.amount) AS taxes_amount, states.country_id FROM taxes
			INNER JOIN counties ON taxes.county_id = counties.id
			INNER JOIN states ON counties.state_id = states.id
			WHERE counties.id = NEW.county_id
			GROUP BY states.country_id
		) innerSelect ON countries.id = innerSelect.country_id
		SET countries.taxes_amount = innerSelect.taxes_amount;
	END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `after_taxes_insert`');
    }
}
