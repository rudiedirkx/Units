Feature: Temperature
	Do Temperature calculations.

	Scenario: Convert one way
		Given I start with "295" "k" of "Temperature"
		Then I should have "21.85" "c"

	Scenario: Convert another way
		Given I start with "295" "c" of "Temperature"
		Then I should have "568.15" "k"

	Scenario: Convert from 0
		Given I start with "0" "f" of "Temperature"
		Then I should have "255.3722" "k"

	Scenario: Convert to 0
		Given I start with "32" "f" of "Temperature"
		Then I should have "0" "c"

	Scenario: In every unit
		Given I start with "80" "f" of "Temperature"
		Then I should have all:
			| f |  80      |
			| c |  26.6667 |
			| k | 299.8167 |
