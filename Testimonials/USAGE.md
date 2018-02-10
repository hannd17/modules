
# Testimonials Module

## How to use
This acts as a submit, approve and get API for a website.
It will return responses in JSON format.

### Submitting a testimonial
```POST /submit.php {text: text, name: name}```
Response: 
```JSON
{status: status, message: message}
```

### Approving a testimonial
```GET /approve.php {uid: UNIQUE TESTIMONIAL ID}```
Response: 
```JSON
{status: status, message: message}
```

### Retrieving testimonials
```GET /get.php'''
Response: 
```JSON
{status: status, testimonials: [testimonials, ...}
```
