pipeline {
    agent any

    environment {
        REPOSITORY_NAME = 'https://github.com/AryanaIH/Project-E-office-main.git'
        BRANCH = 'main'
    }

    stages {
        stage('Build') {
            steps {
                script {
                    // Build the project
                    echo 'Building...'
                    git branch: "$BRANCH", url: "$REPOSITORY_NAME"
                    sh 'cp .env.example .env'
                    sh 'docker compose down'
                    sh 'docker compose up -d --build'
                    sh 'docker compose exec -T php composer install'
                    sh 'docker compose exec -T php npm install'
                    sh 'docker compose exec -T php php artisan key:generate'
                    sh 'docker compose exec -T php php artisan migrate:fresh --seed'
                    sh 'docker compose exec -T php npm run build'
                    sh 'chmod -R 777 public/templates || true'
                }
            }
        }
        stage('Deploy') {
            steps {
                script {
                    // Deploy the project
                    echo 'Deploying...'
                }
            }
        }
    }

    post {
        success {
            echo "✅ Deployment successful. Visit: http://<ip-server>"
        }
        failure {
            echo "❌ Deployment failed! Check logs for details."
            sh 'docker compose logs'
        }
    }
}