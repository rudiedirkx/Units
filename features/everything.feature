Feature: All quantities and units
	Test all metadata and conversions between all units in all quantities

	Scenario Outline: Available units per quantity
		Then I should have "<Number>" "<Quantity>" units

		Examples:
			| Quantity    | Number |
			| Mileage     | 4      |
			| Temperature | 3      |
			| Volume      | 3      |
			| Time        | 6      |

	Scenario Outline: All kinds of conversions
		Given I start with <StartAmount> <StartUnit> of <Quantity>
		# Then I should have <ResultAmount> <ResultUnit>
		When I convert it to <ResultUnit>
		Then I should have <ResultAmount>

		Examples:
			| Quantity    | StartAmount | StartUnit | ResultAmount | ResultUnit |

			| Time        |    1        | s         |   1000       | ms         |
			| Time        |    2        | d         | 172800       | s          |
			| Time        |   12        | h         |      0.5     | d          |
			| Time        |   10        | m         |    600       | s          |
			| Time        | 1000        | m         |      0.6944  | d          |

			# Volume
			| Volume      |    1        | l         |    1         | l          |
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
			| Mileage     |   50        | mpusg     |    4.7043    | lp100km    |

			# Temperature
			| Temperature |  300        | k         |   26.8500    | c          |
			| Temperature |    0        | k         | -459.6700    | f          |
			| Temperature |   20        | c         |   68         | f          |
			| Temperature |   80        | f         |  299.8167    | k          |
			| Temperature |  100        | f         |   37.7778    | c          |
