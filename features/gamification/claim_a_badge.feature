Feature: Claim a badge

  @acceptance @end-to-end-api
  Scenario: Claim a badge
    Given a badger member Michel
    And a badge "My name is Michel" "A superb badge"
    When I claim the badge "My name is Michel"
    Then I should see 1 claimed badge
