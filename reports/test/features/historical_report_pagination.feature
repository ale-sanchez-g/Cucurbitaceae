Feature: I want to have historical reports with pagination

  @home
  Scenario Outline: can see top "<number>"
    Given I have more than x "<number>" of completed runs
    When I navigate to my dashboard
    Then  I can see the first "<number>" records on my table
    Examples:
      | number |
      | 10     |
      | 50     |
      | 100    |