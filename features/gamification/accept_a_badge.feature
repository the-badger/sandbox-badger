Feature: Accept a badge

  @acceptance @end-to-end-api
  Scenario: Accept a badge
    Given a badger member Michel
    And a badge "My name is Michel" "A superb badge"
    When I claim the badge "My name is Michel"
    And I accept the badge "My name is Michel"
    Then I should see 1 earned badge
