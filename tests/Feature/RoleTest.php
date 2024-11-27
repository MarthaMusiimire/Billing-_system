<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

it('can render the roles index page', function () {
    $user = User::factory()->admin()->create();
    $this->actingAs($user)->get('/roles')->assertStatus(200);

});

it('can see create view for roles', function() {
    //create a new admin user
    $user = User::factory()->admin()->create();
    
    //authenticate user
    $this->actingAs($user);

    //get the create view endpoint
    $response = $this->get('roles/create');

    //assert status code
    $response->assertStatus(200);

});

it('can create a new role', function(){
    //create a new admin user
    $user = User::factory()->admin()->create();

    //authenticate user
    $this->actingAs($user);

    //get the create view endpoint
    $response = $this->post('roles', [
        'name' => 'Clinician',
    ]);
    //assert status code
    $response->assertRedirect('roles');

});

it('can delete a role', function(){
    $user = User::factory()->admin()->create();
    $this->actingAs($user);

    $role = Role::create([
        'name' => 'programmer',
    ]);

    $response = $this->delete("roles/$role->id");

    //get the latest role in the database
    $latestRole = Role::latest()->first();

    //expect not to be the deleted role
    expect($latestRole)->not->toBe($role->name);

    //assert databse not to have role marthakay
    $this->assertDatabaseMissing('roles', ['id' => $role->id]);
    


});