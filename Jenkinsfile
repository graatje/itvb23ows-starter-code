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
                withSonarQubeEnv('hive_sonarqube'){
                    sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=ows_kevin"
                }
            }
        }
    }
}