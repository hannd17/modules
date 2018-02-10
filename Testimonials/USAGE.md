# Testimonials Module

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
