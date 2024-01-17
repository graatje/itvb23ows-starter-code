pipeline {
    agent any 
    stages {
        stage('build') {
            steps {
                echo 'Hello Worlds'
            }
        }
        stage('SonarQubeScanner'){
            steps{
                script {scannerHome = tool 'hive_sonarqube'}
                withSonarQubeEnv('SonarQube'){
                    sh "${scannerHome}/bin/sonar-scanner"
                }
            }
        }
    }
}