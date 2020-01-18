Feature: Create a badge

  @acceptance
  Scenario: Create a badge
    Given a badger "admin" "Michel"
    When I create a badge "My name is Michel" "Superb badge"
    Then I should see 1 badge
