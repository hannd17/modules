# Testimonials Module

## How to use
This acts as a submit, approve and get API for a website.
It will return responses in JSON format.

### Submitting a testimonial
'''bash
POST /submit.php {text: text, name: name}
'''
Response: 
'''javscript
{status: status, message: message}
'''

### Approving a testimonial
'''bash
GET /approve.php {uid: UNIQUE TESTIMONIAL ID}
'''
Response: 
'''javascript
{status: status, message: message}
'''

### Retrieving testimonials
'''bash 
GET /get.php
'''
Response: 
'''javascript
{status: status, testimonials: [testimonials, ...}
'''
