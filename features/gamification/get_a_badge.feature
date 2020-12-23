Feature: Get a badge

  @acceptance @end-to-end-api
  Scenario: Get a badge
    Given a badger member Michel
    And a badge "My name is Michel" "A superb badge"
    Then I should see the badge "My name is Michel"
