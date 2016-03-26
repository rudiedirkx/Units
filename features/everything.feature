Feature: All quantities and units
	Test all metadata and conversions between all units in all quantities

	Scenario Outline: Available units per quantity
		Then I should have "<Number>" "<Quantity>" units

		Examples:
			| Quantity    | Number |
			| Mileage     | 4      |
			| Temperature | 3      |
			| Volume      | 3      |

	Scenario Outline: All kinds of conversions
		Given I start with <StartAmount> <StartUnit> of <Quantity>
		# Then I should have <ResultAmount> <ResultUnit>
		When I convert it to <ResultUnit>
		Then I should have <ResultAmount>

		Examples:
			| Quantity    | StartAmount | StartUnit | ResultAmount | ResultUnit |

			# Volume
			| Volume      |  1          | l         |    1         | l          |
			| Volume      |  350        | usg       | 1324.8935    | l          |
			| Volume      | 1000        | l         |  264.1722    | usg        |
			| Volume      | 1000        | l         |  219.9692    | bg         |
			| Volume      |   80        | bg        |   96.0760    | usg        |

			# Mileage
			| Mileage     |    1        | kmpl      |    1         | kmpl       |
			| Mileage     |   25        | kmpl      |    4         | lp100km    |
			| Mileage     |    3        | lp100km   |   33.3333    | kmpl       |
			| Mileage     |   25        | kmpl      |   58.8036    | mpusg      |
			| Mileage     |   25        | kmpl      |   70.6205    | mpbg       |
			| Mileage     |   50        | mpusg     |   60.0477    | mpbg       |
			| Mileage     |   50        | mpusg     |    4.7042    | lp100km    |
