pipeline {
    agent any 
    stages {
        stage('build') {
            steps {
                echo 'Hello Worlds'
            }
        }
        stage('SonarQube Analysis') {
            def scannerHome = tool 'hive_sonarqube';
            withSonarQubeEnv() {
            sh "${scannerHome}/bin/sonar-scanner"
            }
        }
    }
}