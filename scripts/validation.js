
// The password validation with javascript to check if password and confirm passwprd is matched or not.
var check = function() {
  // If matched style is changed to green background
    if (document.getElementById('password').value ==
      document.getElementById('confirm_password').value) {
      document.getElementById('message').style.color = 'white';
      document.getElementById('message').style.backgroundColor = 'green';
      document.getElementById('message').style.borderRadius = '0.5vw';
      document.getElementById('message').style.paddingLeft = '1vw';
      document.getElementById('message').style.paddingRight = '1vw';
      document.getElementById('message').style.width = '10vw';
      document.getElementById('message').innerHTML = 'password matched';
    } else {
      // If didn't match background color is changed to red
      document.getElementById('message').style.color = 'white';
      document.getElementById('message').style.backgroundColor = 'rgba(255,0,0,0.4)';
      document.getElementById('message').style.borderRadius = '0.5vw';
      document.getElementById('message').style.paddingLeft = '1vw';
      document.getElementById('message').style.paddingRight = '1vw';
      document.getElementById('message').style.width = '10vw';
      document.getElementById('message').innerHTML = 'password didn\'t match.';
    }
  }
