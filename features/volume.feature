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

	Scenario: Number of units
		# UPDATE THE TABLE BELOW IF YOU UPDATE THIS NUMBER
		Then I should have "3" "Volume" units
		# UPDATE THE TABLE BELOW IF YOU UPDATE THIS NUMBER

	Scenario Outline: In every unit
		Given I start with "15" "l" of "Volume"
		Then I should have <Result> <Unit>

		Examples:
			| Unit | Result  |
			| l    | 15      |
			| usg  |  3.9626 |
			| bg   |  3.2995 |
