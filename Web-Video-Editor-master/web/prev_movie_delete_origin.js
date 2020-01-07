$(document).ready(function(){
    $('#run_ffmpeg').on('click', function(){
        // $("#previd").click(function(){
        
            var firebase = require("firebase");
        
            // Initialize Firebase
            // TODO: Replace with your project's customized code snippet
            var config = {
                apiKey: "AIzaSyCdWuJ--eN4HgU6UbH5YUupoAJroZH9dGk",
                authDomain: "sohn123-f1d8d.firebaseapp.com",
                databaseURL: "https://sohn123-f1d8d.firebaseio.com",
                storageBucket: "sohn123-f1d8d.appspot.com",
                };
                firebase.initializeApp(config);
                
              var storageRef = firebase.storage().ref();
        
            //   alert("prev_image_delete : " + prevfile);
        
              var deleteRef = storageRef.child('ccc/' + prevfile);
        
              if(prevfile){
                deleteRef.delete().then(function(){
                    // alert("기존 파일 이미지 삭제");
                    console.log("기존 영상 삭제");
                }).catch(function(error){
                    console.log(error.code);
                });
        
              }
              else{
                // alert("기존 파일이 존재하지 않음");
                console.log("기존 영상이 존재하지 않음");
              }
          });
});
