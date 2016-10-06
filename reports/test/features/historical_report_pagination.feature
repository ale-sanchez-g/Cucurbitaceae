Feature: I want to have historical reports with pagination

  @home
  Scenario Outline: can see top "<number>"
    Given I have more than x "<number>" of completed runs
    When I navigate to my dashboard
    And I click on the "<number>" of rows a want to see
    Then  I can see the first "<number>" records on my table
    Examples:
      | number |
      | 10     |
      | 50     |
      | 100    |