$(document).ready(function(){
    $("#clicktrash").click(function(){

        console.log(file_array);
        console.log(file_array.length);
    
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
    
        for(i=0; i<file_array.length; i++){
            var deleteRef = storageRef.child('bbb/' + file_array[i]);
    
            if(file_array[i]){
              deleteRef.delete().then(function(){
                  // alert("기존 파일 이미지 삭제");
                  console.log("파일삭제 : " + file_array[i]);
              }).catch(function(error){
                  console.log(error.code);
              });
      
            }
            else{
              // alert("기존 파일이 존재하지 않음");
              console.log("파일 X");
            }
        }


    });
});