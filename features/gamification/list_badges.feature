Feature: List badges

  @acceptance @end-to-end-api
  Scenario: Claim a badge
    Given a badger member Michel
    And a badge "My name is Michel" "A superb badge"
    And a badge "List badges" "I can successfully list all badges"
    Then I should see 2 badge
