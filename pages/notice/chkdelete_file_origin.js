$(document).ready(function(){
    $("#clicktrash").click(function(){
  
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

      console.log(noticearr);

      const noticecall = function(callback){

      if(noticearr){
          for(var j=0; j<noticearr.length; j++){
              if(noticearr[i]){
                  var deleteRef1 = storageRef.child('notice/' + noticearr[i]);

                  deleteRef1.delete().then(function(){
                        console.log("공지사항 파일 삭제: " , noticearr[i]);
                        callback();
                  }).catch(function(error){
                        console.log(error.code);
                    });

                    }
                }
            }
        }

        noticecall(function(){
            console.log("삭제");
            location.reload();
        });
    });
 });