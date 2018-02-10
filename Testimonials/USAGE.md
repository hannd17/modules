# Testimonials Module

## How to use
This acts as a submit, approve and get API for a website.
It will return responses in JSON format.

### Submitting a testimonial
```POST /submit.php {text: text, name: name}```
Response: 
```{status: status, message: message}```

### Approving a testimonial
```GET /approve.php {uid: UNIQUE TESTIMONIAL ID}```

Response: 
```{status: status, message: message}```

### Retrieving testimonials
```GET /get.php```

Response: 
```{status: status, testimonials: [testimonials, ...]}```
