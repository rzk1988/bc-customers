# Some thoughts
* I created a service layer that contains most logic injects into the controllers.
* For first task, initially I used getOrdersCount() method to get the count of the orders. But it is inevitable to put 
  the api calls in a loop, which the performance is bad. So I decided to get all orders to count for each customers.
* For second task, I created getLifeTimeValue method to calculate the life time value, which causes one more loop, but 
  the structure would be better for testing, maintanence and readable. Also the time complexity remains the same.
* For both tasks, I believe that it is worthy to build cache tables to improve the performance and avoid to call api so many
  times, which I did not finsihed due to the time limit.

