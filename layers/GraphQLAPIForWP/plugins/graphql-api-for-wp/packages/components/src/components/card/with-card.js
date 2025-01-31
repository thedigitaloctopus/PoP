/**
 * Internal dependencies
 */
import { createHigherOrderComponent } from '@wordpress/compose';
import { Card, CardHeader, CardBody } from '@wordpress/components';
import { MarkdownInfoModalButton } from '../markdown-modal';
import { __ } from '@wordpress/i18n';

/**
 * Display an error message if loading data failed
 */
const withCard = () => createHigherOrderComponent(
	( WrappedComponent ) => ( props ) => {
		const {
			header,
			getMarkdownContentCallback
		} = props;
		const documentationTitle = __(`Documentation for: "${ header }"`, 'graphql-api');
		return (
			<Card { ...props }>
				<CardHeader isShady>
					<span>
						{ header }
						{ !! getMarkdownContentCallback && (
							<MarkdownInfoModalButton
								title={ documentationTitle }
								getMarkdownContentCallback={ getMarkdownContentCallback }
							/>
						) }
					</span>
				</CardHeader>
				<CardBody>
					<WrappedComponent
						{ ...props }
					/>
				</CardBody>
			</Card>
		);
	},
	'withCard'
);

export default withCard;
