Feature: Volume
	Do Volume calculations, and test the Quantity object basis.

	Background: Start with 15 l
		Given I start with "15" "l" of "Volume"

	Scenario: Remember input quantity
		Then I should have "15"

	Scenario: Remember input unit
		Then I should have "15" "l"

	Scenario: Convert persistently
		When I convert it to "usg"
		Then I should have "3.9626"

	Scenario: Convert directly
		Then I should have "3.9626" "usg"

	Scenario: In every unit
		Then I should have all:
			| l   | 15      |
			| usg |  3.9626 |
			| bg  |  3.2995 |
