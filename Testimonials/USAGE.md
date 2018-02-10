# Testimonials Module

## Setup

1. Rename ```ExampleCongfig.php``` to ```Config.php```
2. Replace ```ADMIN_EMAIL```, ```NOREPLY_EMAIL```, ```ADMIN_NAME``` and ```WEB_ADDRESS```.
3. Create page that uses the API endpoints described below. 

## How to use
This acts as a submit, approve and get API for a website.
It will return responses in JSON format.

### Submitting a testimonial
```POST /submit {testimonial: testimonial, name: name}```
Response: 
```{status: status, message: message}```

### Approving a testimonial
```GET /approve {uid: UNIQUE TESTIMONIAL ID}```

Response: 
```{status: status, message: message}```

### Retrieving testimonials
```GET /get```

Response: 
```[testimonial, ...]```

## Todo:

- Create a setup page which will allow users to enter the defines needed in Config.php
