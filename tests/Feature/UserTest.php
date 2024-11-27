<?php

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;



uses(RefreshDatabase::class);

//test for viewing the index pages for users.
it('can render index view for users', function(){
    $user = User::factory()->admin()->create();
    $this->actingAs($user)->get('/users')->assertStatus(200);

});





//test for viewing the create page for users
it('can render the create page for users', function(){
    $user = User::factory()->admin()->create();
    $this->actingAs($user)->get('/users/create')->assertStatus(200);
});




//test for creating a new user
it('can create a new user', function(){
    $admin = User::factory()->create(); // Create an admin user
    $this->actingAs($admin);

    //seeding the roles 
    $this->seed(RoleSeeder::class);


    $userData = [
        'name' => 'John Doe',
        'email' => 'johnCrystal@gmail.com',
        'password' => 'password123',
        'roles' => ['admin']
    ];

    // Send a POST request to create the user
    $response = $this->post(route('users.store'), $userData);


    // Assert the response redirects to the index page
    $response->assertRedirect(route('users.index'));

    // Assert the user exists in the database
    $this->assertDatabaseHas('users', [
        'name' => $userData['name'],
        'email' => $userData['email'],
    ]);



});


//test for editing a user.

it('can update a user', function(){
   

    $user = User::factory()->create(); // Create a user
    $this->actingAs($user); 
    
     //seeding the roles 
     $this->seed(RoleSeeder::class);

    // Assign the role explicitly for the test
    $user->assignRole('admin');

    // Data to update the user
    $updatedData = [
        'name' => 'Updated Name',
        'email' => 'updatedemail@gmail.com',
        'password' => bcrypt('newpassword123'),
        'role' => 'admin',  // Ensure the role is passed here
    ];

    // Send the PUT request to update the user
    $response = $this->put(route('users.update', $user->id), $updatedData);

    // Assert the response redirects to the users index page
    $response->assertRedirect(route('users.index'));


    // Assert the user's data is updated in the database
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Updated Name',
        'email' => 'updatedemail@gmail.com',
    ]);

});



it('can soft delete a user', function () {
    // Arrange: Create an admin user and a user to be deleted
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    // Perform the soft delete while authenticated as admin
    $this->actingAs($admin)->delete('users/' . $user->id)->assertRedirect(); // Assert the redirect occurs

    // Check if the 'deleted_at' column is set (user is soft deleted)
    $this->assertSoftDeleted('users', ['id' => $user->id]);

    // Check if the user still exists in the database but is marked as deleted
    $user->refresh();
    expect($user->deleted_at)->not()->toBeNull();
});









