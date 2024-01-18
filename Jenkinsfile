node {
  stage('SCM') {
    checkout scm
  }
  stage('SonarQube Analysis') {
    def scannerHome = tool 'SonarQube';
    withSonarQubeEnv(installationName: 'SonarQube') {
      sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=ows_kevin"
    }
  }
}