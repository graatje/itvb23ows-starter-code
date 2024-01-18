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
                script {scannerHome = tool 'SonarQube'}
                withSonarQubeEnv('SonarQube'){
                    sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=ows_kevin"
                }
            }
        }
    }
}