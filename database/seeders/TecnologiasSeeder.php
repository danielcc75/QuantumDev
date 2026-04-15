<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tecnologia;

class TecnologiasSeeder extends Seeder
{
    public function run(): void
    {
        $catalogo = [
            'Frontend'             => ['React', 'Vue.js', 'Angular', 'Svelte', 'Next.js', 'Nuxt.js', 'HTML', 'CSS', 'Tailwind CSS', 'Bootstrap', 'jQuery', 'TypeScript'],
            'Backend'              => ['Node.js', 'Express', 'Django', 'FastAPI', 'Spring Boot', 'Laravel', 'Ruby on Rails', 'ASP.NET', 'Flask', 'NestJS', 'Phoenix'],
            'Lenguajes'            => ['JavaScript', 'TypeScript', 'Python', 'Java', 'C#', 'C++', 'C', 'PHP', 'Ruby', 'Go', 'Rust', 'Swift', 'Kotlin', 'Dart', 'R'],
            'Bases de Datos'       => ['MySQL', 'PostgreSQL', 'MongoDB', 'SQLite', 'Redis', 'MariaDB', 'Oracle', 'SQL Server', 'Cassandra', 'Firebase', 'Supabase'],
            'Cloud & DevOps'       => ['AWS', 'Google Cloud', 'Azure', 'Docker', 'Kubernetes', 'GitHub Actions', 'GitLab CI', 'Terraform', 'Ansible', 'Jenkins', 'Nginx'],
            'Mobile'               => ['React Native', 'Flutter', 'Android', 'iOS', 'Ionic', 'Xamarin', 'Expo'],
            'APIs & Real-time'     => ['REST API', 'GraphQL', 'WebSockets', 'gRPC', 'Swagger', 'Postman', 'Socket.io'],
            'Testing'              => ['Jest', 'PHPUnit', 'Cypress', 'Selenium', 'Pytest', 'JUnit', 'Mocha', 'Vitest'],
            'Data Science & ML'    => ['TensorFlow', 'PyTorch', 'Scikit-learn', 'Pandas', 'NumPy', 'Keras', 'OpenCV', 'Jupyter'],
            'Diseño & Prototipado' => ['Figma', 'Adobe XD', 'Sketch', 'InVision', 'Canva'],
            'Gestión de Proyectos' => ['Git', 'GitHub', 'GitLab', 'Jira', 'Trello', 'Notion', 'Slack', 'Linear'],
        ];

        foreach ($catalogo as $categoria => $tecnologias) {
            foreach ($tecnologias as $nombre) {
                Tecnologia::firstOrCreate(
                    ['nombre' => $nombre, 'categoria' => $categoria]
                );
            }
        }
    }
}
