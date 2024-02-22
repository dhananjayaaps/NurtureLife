pipeline{

    agent any

    stages{
        stage('Deploy to Remote'){
            steps{
            sh 'scp ${workspace}/target/*.war root@
            }
       
}