<?php

namespace Tests\Feature;

use App\Models\Animal;
use App\Models\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_opens(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_animals_page_opens(): void
    {
        $response = $this->get('/animals');

        $response->assertStatus(200);
    }

    public function test_about_page_opens(): void
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
    }

    public function test_help_page_opens(): void
    {
        $response = $this->get('/help');

        $response->assertStatus(200);
    }

    public function test_contacts_page_opens(): void
    {
        $response = $this->get('/contacts');

        $response->assertStatus(200);
    }

    public function test_animal_detail_page_opens(): void
    {
        $animal = Animal::create([
            'name' => 'Мурка',
            'type' => 'Кіт',
            'age' => 2,
            'description' => 'Дружня кішка, яка шукає дім.',
            'image' => 'cat.png',
            'status' => 'Шукає дім',
            'breed' => 'Домашня',
            'gender' => 'Дівчинка'
        ]);

        $response = $this->get('/animals/' . $animal->id);

        $response->assertStatus(200);
        $response->assertSee('Мурка');
    }

    public function test_application_can_be_submitted(): void
    {
        $animal = Animal::create([
            'name' => 'Рекс',
            'type' => 'Собака',
            'age' => 3,
            'description' => 'Добрий собака.',
            'image' => 'dog.png',
            'status' => 'Шукає дім',
            'breed' => 'Дворняга',
            'gender' => 'Хлопчик'
        ]);

        $response = $this->post('/applications', [
            'animal_id' => $animal->id,
            'name' => 'Іван Петренко',
            'phone' => '0987654321',
            'email' => 'ivan@example.com',
            'message' => 'Хочу усиновити цю тварину.'
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('applications', [
            'animal_id' => $animal->id,
            'name' => 'Іван Петренко',
            'email' => 'ivan@example.com',
            'status' => 'Нова'
        ]);
    }

    public function test_application_validation_errors(): void
    {
        $response = $this->post('/applications', [
            'animal_id' => '',
            'name' => '',
            'phone' => '',
            'email' => 'wrong-email',
            'message' => ''
        ]);

        $response->assertSessionHasErrors([
            'animal_id',
            'name',
            'phone',
            'email',
            'message'
        ]);
    }

    public function test_profile_page_redirects_guest(): void
    {
        $response = $this->get('/profile');

        $response->assertRedirect('/login');
    }

    public function test_applications_page_redirects_guest(): void
    {
        $response = $this->get('/applications');

        $response->assertRedirect('/login');
    }

    public function test_help_requests_page_redirects_guest(): void
    {
        $response = $this->get('/help_requests');

        $response->assertRedirect('/login');
    }

    public function test_users_page_is_not_available_for_guest(): void
    {
        $response = $this->get('/users');

        $response->assertStatus(403);
    }
}