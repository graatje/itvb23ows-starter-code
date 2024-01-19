node {
  stage('SCM') {
    checkout scm
  }
  stage('SonarQube Analysis') {
    def scannerHome = tool 'SonarScanner';
    withSonarQubeEnv() {
      sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=kevin_ows -Dsonar.login=admin -Dsonar.password=464c52b24e6c4405af9fe492910c54c6"
    }
  }
}