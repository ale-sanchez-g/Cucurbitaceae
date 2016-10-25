Feature: I want to have historical reports

  @dashboard
  Scenario: I can navigate to my dashboard
    Given I navigate to my dashboard
    And   I can see a table with the historical results
    When  I review the content of my table
    Then  I can see the below fields
    | ID | TEST_NAME | DATE | STATUS | AGENT | DOMAIN | TAGS |

  @load @watch
  Scenario: After every run of my test case I what to see the result in my report
    Given The test execution is completed with the below results
    | ID       | TEST_NAME                 | DATE      | STATUS  |  AGENT | DOMAIN | TAGS      |
    | UniqueID | I am testing this         | Date Now  | 0       | 1      | AWW    | @TODO     |
    | UniqueID | I am testing this FAIL    | Date Now  | 1       | 1      | HOMES  | @TODO     |
    | UniqueID | I am testing this no tag  | Date Now  | 0       | 1      | FOOD   | undefined |

    When  I navigate to my dashboard
    Then  I can see the result at the top of the table
      | ID       | TEST_NAME                 | DATE      | STATUS  |  AGENT | DOMAIN | TAGS      |
      | UniqueID | I am testing this         | Date Now  | 0       | 1      | AWW    | TODO     |
      | UniqueID | I am testing this FAIL    | Date Now  | 1       | 1      | HOMES  | TODO     |
      | UniqueID | I am testing this no tag  | Date Now  | 0       | 1      | FOOD   | undefined |

  @load
  Scenario: Load will fail if ID already exists
    Given The test execution is completed with duplicate results
      | ID        | TEST_NAME                 | DATE      | STATUS  |  AGENT | DOMAIN | TAGS      |
      | UniqueID  | I am testing this         | Date Now  | 0       | 1      | AWW    | @TODO     |
      | PreviusID | I am testing this         | Date Now  | 0       | 1      | AWW    | @TODO     |
    Then I will be presented with the Message "MySQL Error: Duplicate entry"

  @dashboard
  Scenario: Dashboard image reflects the table data
    Given The test execution is completed with the below results
      | ID       | TEST_NAME                 | DATE      | STATUS  | TAGS      |
      | UniqueID | I am testing this         | Date Now  | 0       | @TODO     |
      | UniqueID | I am testing this FAIL    | Date Now  | 1       | @TODO     |
      | UniqueID | I am testing this no tag  | Date Now  | 0       | undefined |
      | UniqueID | I am testing this FAIL    | Date Now  | 1       | @TODO     |
    When  I navigate to my status count page
    Then  I can see the status 0 is 2 and status 1 is 2

  @refine
  Scenario: User is able to refine the reporting base on tags
    Given The test execution is completed with the below results
      | ID       | TEST_NAME                 | DATE      | STATUS  | TAGS      |
      | UniqueID | I am testing this         | Date Now  | 0       | @TODO     |
      | UniqueID | I am testing this FAIL    | Date Now  | 1       | undefined |
      | UniqueID | I am testing this no tag  | Date Now  | 0       | undefined |
      | UniqueID | I am testing this FAIL    | Date Now  | 1       | @TODO     |
    When I navigate to my dashboard
    Then I can refine my report base on "TODO" tag
    And  I can see there are 2 records on the table
    And  I can go back to the Dashboard using the "Home" link


  @refine
  Scenario: User is able to refine the reporting base on scenario name
    Given The test execution is completed with the below results
      | ID       | TEST_NAME                 | DATE      | STATUS  | TAGS      |
      | UniqueID | I am testing this         | Date Now  | 0       | @TODO     |
      | UniqueID | I am testing this FAIL    | Date Now  | 1       | undefined |
      | UniqueID | I am testing this no tag  | Date Now  | 0       | undefined |
      | UniqueID | I am testing this FAIL    | Date Now  | 1       | @TODO     |
    When I navigate to my dashboard
    Then I can refine my report base on "I am testing this FAIL" scenario name
    And  I can see there are 2 records on the table
    And  I can go back to the Dashboard using the "Home" link

  @refine
  Scenario: User is able to refine the reporting base on multiple tags
    Currently the tool can only support 1 tag
    Given The test execution is completed with the below results
      | ID       | TEST_NAME                 | DATE      | STATUS  | TAGS       |
      | UniqueID | I am testing this         | Date Now  | 0       | @TODO,@tag |
      | UniqueID | I am testing this FAIL    | Date Now  | 1       | @TODO,@tag |
    When I navigate to my dashboard
    Then I can refine my report base on "tag" tag
    And  I can see there are 2 records on the table