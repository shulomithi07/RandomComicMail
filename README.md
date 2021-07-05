# XKCD EMAIL CHALLENGE
##### _SIGNUP LOGIN ACTIVATE SUBSCRIBE RECEIVE EMAIL_
### [ASSIGNMENT LINK](https://xkcd-mail.herokuapp.com/)


##
##

The languages used in this challenge are PHP, HTML, CSS, JAVASCRIPT. Hosted with the help of HEROKU. A mobile-ready application it is.


## Features of the website
- ##### SIGNUP
- ##### LOGIN
- ##### ACTIVATE MAIL
- ##### RECURRING EMAIL
- ##### RESPONSIVE


##  TECHNOLOGIES

- ##### PHP 8.0.3
- ##### HTLM5
- ##### CSS3
- ##### JAVASCRIPT 1.7



## The Beginning
##### SIGNUP:
When the user enters credentials and submits, a random token is generated through code and attached to the activation mail URL. The activation URL points to the "activation.php" page, where the user's inactive status changes to active in the database. When the code sends mail to the user, the page redirects to the login page with a session message " Check your email for activation link {with @email}.". 
#

![SignUp Page Image](https://lh3.googleusercontent.com/FrCZvDOXQsT-Q5WRqgXAJgSEJYcd0aa9lE4ExE-Ra7Stchz0_y2NDsyS_Zcd-kPdmztrCS1yeJdDDGy8UASMvr5k232PZq12SGUqfzZUiKD1ptxLDVyekr95IQ28YXQNoIwBGRGOZL0=w2400 "SignUp")

#
After the user clicks the activation mail:
The mail redirects to the "activation.php" page, where the URL pattern of the "activation.php" page has a token in it, and it is accessible by the "GET" method.
 If the token from the URL matches the database token, then the user's inactive status changes to active. After that, the page redirects to the login page with a session message "YOUR ACCOUNT IS ACTIVATED PLEASE LOGIN."

#
![Activation Page Image](https://lh3.googleusercontent.com/R87EQZE-Lrub-1gAMJhiqBWq8EGVyfRYUMWe8QYMKkCojGxbnDlCX666k-5a1CFQSqteuvRdUVK30r8R6QQYStoe6awGYQcO-sWFPK_hdNt0tcmX_uXGYf23MlAeig1ts9M3TOtk97k=w2400 "Activation")
#

##### LOGIN:

As the user has an account now, he can directly log in to his account and access the features. If the user credentials are not present in the database, and the user tries to log in, then an alert message is shown that the account doesn't exist and asks him to signup. There is also a feature of forgot password on the login page, which helps the user reset his/her password. 

To reset the password when he forgets user can use the forgot password link in which he has to enter his mail id. He will get an email with the reset password link through which he can reset the password.

#
![Login Page Image](https://lh3.googleusercontent.com/4-YwGYPd5G_4RyE4H8ZDOC_vReBa0TXpbmi4oq_SILrv4_LwfV1TeChAliyx0_k--gngKwD96wcZFO2IuACMB-HuoJUuOcsLIIZoUITQPtCL5Sq-3aCHX1SXSiBI5N_tD4LytJraVoo=w2400 "Login")
#

##### HOMEPAGE:
So far, now the user has just created an account and logged in to it. 
The user's nickname is printed on the screen saying hello when he logs in. 
If the user is already an account holder he is directly logged in.

#
![HomePage Image](https://lh3.googleusercontent.com/LeqjRBYPcmK8jBatToNyr7HUiZtnhnjuDNK2USnP25PQBKDkAS6BZ5zEv3n-QxNJTiJKiZca8LSDCu29UzFIvdnXbuDIfEjdVkvBS_YCELupXMQzNd8TkHv5LK-n-bPnXEMn4Yw8BOA=w2400 "HOMEPAGE")    
#

## ACTIVATE

- ##### activate form:

    There is a button named activate on the homepage which on clicked changes users subscribed status to 'yes' which implies he/she will be getting emails from now on.
  
- ##### subscribe.php
 

 When the user clicks on the activate button first it redirects to subscribe page and verifies the user subscribed status. If the user is already subscribed to the mailing list, the activate page redirects the user to the homepage and tells the user that he is already subscribed. If the user is activating for the first time, the subscribe.php page redirects to firstMail.php where the user gets his first mail after he is subscribed and the user gets to know that he will be receiving emails from know on. display details about the upload process in the upload block.
        
 #
 ![Activate Image](https://lh3.googleusercontent.com/A1geJDybqf0ZOWFGXTkiYz-oOFgod-MCNyIVo-ugqs1IO5Rgp-iwzeDghY-7l0ekvqqJiGpEK9cS5nEm_EamI7MHKTDSkWX0fBEb-_b9xnQi63Wrtb0E6RWaJE66xNi5fzTfTcytQ_E=w2400 "UPLOAD")    
 #
 
[The activate file link](https://github.com/rtlearn/php-shulomithi07/blob/master/XKCD/subscribe.php)

## RECURRING EMAIL

- ##### Mailing for every 5 mins
        
        
 _User after activating receives emails for every five mins until unless he unsubscribes from it._
There is a mailing script that runs for every five mins with the help of a cron running on it.
What does email contain? The email contains a random comic that is fetched from the XKCD comic site every five mins. First, the metatags of the URL are searched to get the URL of the random comic, and then the URL is sanitized to remove illegal characters. After that, the JSON data from the URL is collected. 

Then from the JSON data, the random image URL is taken and sent to the mail function. This random comic URL is taken from the JSON file of the comic: the randomly generated comic URL.

Before the mailer function, user details like email and name are fetched from the database and send to the mail function 
In the mail function, the user details that are already fetched from the database are used as the recipient in the mail function. And the image is also sent as an attachment to the user. If the user doesn't like the mail he can unsubscribe to the mailing list with the help of the unsubscribing button in the email.

#
   ![Recurring Email Image](https://lh3.googleusercontent.com/SYrZnHw30efrm1hT8jnTQiSBhox63zSDpawvvElZmJDihynVL3kxX7shjnhz3Hb4iaP6hCRQmsUXiWZUqK3-tNdIdRoT85WjmZqFy90OY1rgSx2uvuScqT2F8iabolntNuuMZi5HOrU=w2400 "RESPONSIVE")    
   
   [The recurring mail file link](https://github.com/rtlearn/php-shulomithi07/blob/master/XKCD/recurringMail.php)

## RESPONSIVE

   This website is a mobile-friendly website which implies that the website looks good in any viewport, 
   and it is user-friendly in any viewport. It might be a mobile device or a tablet, or even on a laptop.
   It functions all fine.
  #
   ![Responsive Image](https://lh3.googleusercontent.com/GBuipVLdirBQMzN-T2w_7pzsROQ95e3aJ1CpGmTwxgZjMEZazs70RQA94WzD65Ea9fX1MxIjrPymySJ1wrmj5HwMOqOHyrliNR64S4ZtmGCgjSf4IT7xhq-v1ZR5rv4mlcl7Fk0gJfk=w2400 "RESPONSIVE")    
   #

## Easy Access
| FUNCTIONALITIES |FILES |
| ------ | ------ |
| SIGNUP | https://github.com/rtlearn/php-shulomithi07/blob/master/XKCD/index.php |
| ACTIVATE | https://github.com/rtlearn/php-shulomithi07/blob/master/XKCD/activation.php |
| LOGIN | https://github.com/rtlearn/php-shulomithi07/blob/master/XKCD/login.php |
| HOMEPAGE | https://github.com/rtlearn/php-shulomithi07/blob/master/XKCD/homepage.php |
| SUBSCRIBE| https://github.com/rtlearn/php-shulomithi07/blob/master/XKCD/subscribe.php |
| UNSUBSCRIBE | https://github.com/rtlearn/php-shulomithi07/blob/master/XKCD/unsubscribe.php |
| LOGOUT | https://github.com/rtlearn/php-shulomithi07/blob/master/XKCD/logout.php |



>  _Shulomithi_
