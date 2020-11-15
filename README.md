# Some thoughts
* I created a service layer that contains most logic injects into the controllers.
* For first task, initially I used getOrdersCount() method to get the count of the orders. But it is inevitable to put 
  the api calls in a loop, which the performance is bad. So I decided to get all orders to count for each customers.
* For second task, I created getLifeTimeValue method to calculate the life time value, which cause one more loop, but 
  the structure would be better for testing and readable. Also the time complexity remain the same.
* For both task, I believe that it is worthy to build cache tables to improve the performance and avoid to call api so many
  times, which I did not done dut to the time limit.

