$(document).ready(function(){
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

    console.log(boardfile);
    console.log(sceimg);
    console.log(scevid);

    const allCallback = function(callback){
        if(boardfile){
            for(var k=0; k<boardfile.length; k++){
                var deleteRef1 = storageRef.child('notice/' + boardfile[k]);

                deleteRef1.delete().then(function(){
                    console.log("공지사항 파일 삭제");
                    callback();
                }).catch(function(error){
                    console.log(error.code);
                });
            }
        }

        if(sceimg){
            for(var i=0; i<sceimg.length; i++){
                var deleteRef2 = storageRef.child('bbb/' + sceimg[i]);

                deleteRef2.delete().then(function(){
                    console.log("이미지 파일 삭제");
                    callback();
                }).catch(function(error){
                    console.log(error.code);
                });
            }
        }

        if(scevid){
            for(var j=0; j<scevid.length; j++){
                var deleteRef3 = storageRef.child('ccc/' + scevid[j]);

                deleteRef3.delete().then(function(){
                    console.log("영상 파일 삭제");
                    callback();
                }).catch(function(error){
                    console.log(error.code);
                });
            }
        }

        if(boardfile == "" && sceimg == "" && scevid == ""){
            console.log("파일없음 그냥 삭제");
            location.href="../../index.php";
        }

    }

    allCallback(function(){
        // alert("모든 코스와 시나리오가 삭제되었습니다.");
        console.log("삭제");
        location.href="../../index.php";
    });



});