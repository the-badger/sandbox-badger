Feature: List badges

  @acceptance @end-to-end-api
  Scenario: List all badges
    Given a badger member Michel
    And a badge "My name is Michel" "A superb badge"
    And a badge "List badges" "I can successfully list all badges"
    Then I should be able to list all badges
