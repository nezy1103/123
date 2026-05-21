# Система электронных курсов (E-Course MVP)

Проект по дисциплине "Интернет-программирование"

## 🛠 Технологии
- PHP 8.2 + Apache
- MySQL 8.0
- Docker & Docker Compose
- Git & GitHub

## 📁 Структура
├── public/ # Front Controller, .htaccess
├── src/ # Конфигурации, защита от прямого доступа
├── sql/ # Инициализация БД по шаблону С3
├── docker-compose.yml
├── Dockerfile
└── .env # Переменные окружения (в .gitignore)

## 🚀 Запуск
```bash
docker-compose up -d --build
Приложение доступно: http://localhost:8080
