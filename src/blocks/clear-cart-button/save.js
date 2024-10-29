import { useBlockProps } from '@wordpress/block-editor';

const Save = ({ attributes }) => {
    const {
        label, width, backgroundColor, textColor, padding, paddingTop, paddingRight, paddingBottom, paddingLeft,
        margin, marginTop, marginRight, marginBottom, marginLeft, fontSize, borderRadius,
        borderRadiusTopLeft, borderRadiusTopRight, borderRadiusBottomRight, borderRadiusBottomLeft,
        individualPadding, individualMargin, individualBorderRadius
    } = attributes;

    const paddingStyle = individualPadding ? `${paddingTop}px ${paddingRight}px ${paddingBottom}px ${paddingLeft}px` : `${padding}px`;
    const marginStyle = individualMargin ? `${marginTop}px ${marginRight}px ${marginBottom}px ${marginLeft}px` : `${margin}px`;
    const borderRadiusStyle = individualBorderRadius ? `${borderRadiusTopLeft}px ${borderRadiusTopRight}px ${borderRadiusBottomRight}px ${borderRadiusBottomLeft}px` : `${borderRadius}px`;

    const blockProps = useBlockProps.save({
        style: {
            width,
            backgroundColor,
            color: textColor,
            padding: paddingStyle,
            margin: marginStyle,
            fontSize: `${fontSize}px`,
            borderRadius: borderRadiusStyle,
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            minHeight: '3rem'
        },
    });

    return (
        <button {...blockProps} className="clear-cart-button button" type="button">
            {label}
        </button>
    );
};

export default Save;