<?php

use App\Models\User;


//test for rendering the index page for roles.
it('can render the index page for roles', function () {

    $admin = User::factory()->admin()->create();
    
    $this->actingAs($admin)->get('/roles')->assertStatus(200);
});


//test for viewing the create page for a new role.

it('can view create page for a new role', function(){
    $admin = User::factory()->admin()->create();
    $this->actingAs($admin)->get('/roles/create')->assertStatus(200);

});



//test for creating a new role.
it('can create a new role', function(){
    $admin = User::factory()->admin()->create();
    $response = $this->actingAs($admin)->post('/roles', [
     'name' => 'super admin',   
    ]);
    $response->assertRedirect('/roles');

});


//test for updating a role.
it('can update an existing role', function(){
    $admin = User::factory()->admin()->create();
    $this->actingAs($admin);
    $role = Spatie\Permission\Models\Role::create([
        'name' => 'software developer',

    ]);
    $updatedRole = [
        'name' => 'software designer',
    ];

    $response = $this->put('/roles/' . $role->id, $updatedRole);

    $response->assertStatus(302);
    $this->assertDatabaseHas('roles', ['id' => $role->id, 'name' => 'software designer']);
       
});


//test for deleting a role
it('can delete a role',function(){
    $admin = User::factory()->admin()->create();
    $this->actingAs($admin);
    $role = Spatie\Permission\Models\Role::create([
        'name' => 'software developer',
    ]);

    $response = $this->delete('/roles/'. $role->id);

    $response->assertStatus(302);
    $this->assertDatabaseMissing('roles', ['id' => $role->id]);
});





