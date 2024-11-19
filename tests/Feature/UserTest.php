<?php


use App\Models\User;


beforeEach(function () {
   
    $user = User::factory()->admin()->create();
    $this->actingAs($user);
   
});



//test for rendering the index page.
it('can render the users index page', function () {
  
    $response = $this->get(url('users'));
    $response->assertStatus(200);
    $response->assertSee('Users');
    
});


//test for creating a user.
it('can view create view create form', function () {
  

   $admin = User::factory()->admin()->create();

   $this->actingAs($admin)->get('users/create')->assertStatus(200);

});



it('can create a new user', function(){
    
   $admin = User::factory()->admin()->create();

   $userData = User::factory()->make()->toArray();

   $this->actingAs($admin)->post('users',$userData)->assertRedirect();


});

it('can edit user',function(){
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();
    $this->actingAs($admin)->get('users/'.$user->id.'/edit')->assertStatus(200);


});

it('can update a user',function(){
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    $userData = [
        'name' => 'updatedUser',
        'email' => $user->email,
    ];


    $this->actingAs($admin)->put('users/'.$user->id,$userData)->assertRedirect();

});

it('can delete user',function(){
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    $this->actingAs($admin)->delete('users/'.$user->id)->assertRedirect();

});


