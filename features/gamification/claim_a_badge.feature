Feature: Claim a badge

  @acceptance
  Scenario: Claim a badge
    Given a badger member Michel
    And a badge named "My name is Michel"
    Then I should be able to claim the badge "My name is Michel"
