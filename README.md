# pipeline-example
Practical application of The Pipeline Pattern

### Running Instructions

Pre requisites:
- Docker and Docker-Compose (Dokcer4Mac, Docker VM, etc ...)

Instalation:

- Once you've cloned the repo, go to repo's directory and type `docker-compose up`
- Once yout've seen apache output, test initialization by typing `http://localhost:7560/example/hello` on your web browser
- If you obtained a "hello!" back, then it's all up and running!
- To run the Pipeline example go to `\example\checkout`

Context:

Consider an order transaction in an eCommerce site.

- User places the order and complete all the necessary information (Personal data, Credit card information, Shipping address, Billing address , etc ...)
- Payment processor takes the payment and Invoice is generated and sent to the user
- The order is delivered by some form of delivery service
- Customer is redirected to the thank you view