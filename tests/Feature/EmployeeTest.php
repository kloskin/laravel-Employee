<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Models\Employee;
use \App\Models\Dietary;
use \App\Models\Company;

class EmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testCreateEmployee()
    {
        // Creating record of company
        $company = Company::factory()->create();

        // Creating record of Dietary preferences
        $dietary = Dietary::factory()->create();

        // Create Employee
        $employee = Employee::factory()->create([
            'company_id' => $company->id,
        ]);

        // Check if Employee is created
        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
        ]);

        // Check if Employee is asignd to Company
        $this->assertEquals($company->id, $employee->company->id);

        // Adding Dietary preferences
        $employee->dietaryPreferences()->attach($dietary->id);

        // Check if Dietary preferences is asignd to Employee
        $this->assertTrue($employee->dietaryPreferences->contains('id', $dietary->id));
    }


    public function testListEmployees()
    {
        \App\Models\Dietary::factory(10)->create();
        \App\Models\Company::factory(10)->create();
        // Create few Employees
        $employees = Employee::factory(5)->create();

        // Open site with employee list
        $response = $this->get(route('employees.index'));

        // Check if site returns status HTTP 200 OK
        $response->assertStatus(200);

    }

    public function testEditEmployeeView()
    {
        // Create new Employees
        $employee = Employee::factory()->create();

        // Open site with form to edit Employee
        $response = $this->get(route('employees.edit', $employee));

        // Check if site returns status HTTP 200 OK
        $response->assertStatus(200);

        //Check if site shows First name and last name
        $response->assertSee($employee->first_name);
        $response->assertSee($employee->last_name);
    }
    public function testDeleteEmployee()
    {
        $employee = Employee::factory()->create();

        $response = $this->delete(route('employees.destroy', $employee->id));

        $response->assertRedirect(route('employees.index'));

        // Check if soft delete
        $this->assertSoftDeleted('employees', ['id' => $employee->id]);
    }
    public function testEmployeeValidation()
    {
        $response = $this->post(route('employees.store'), []);

        $response->assertSessionHasErrors(['first_name', 'last_name', 'email', 'company_id']);
    }
    public function testExceptionHandler()
    {
        // Exception
        $this->expectException(\Exception::class);

        // Call Exception
        $response = $this->get(route('some.route.that.throws.exception'));
    }

}
