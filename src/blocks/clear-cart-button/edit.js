import { InspectorControls, useBlockProps, PanelColorSettings } from '@wordpress/block-editor';
import { PanelBody, Button, ButtonGroup, TextControl, RangeControl, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';

const Edit = ({ attributes, setAttributes }) => {
    const {
        label, width, backgroundColor, textColor, padding, paddingTop, paddingRight, paddingBottom, paddingLeft,
        margin, marginTop, marginRight, marginBottom, marginLeft, fontSize, borderRadius,
        borderRadiusTopLeft, borderRadiusTopRight, borderRadiusBottomRight, borderRadiusBottomLeft
    } = attributes;

    const [individualPadding, setIndividualPadding] = useState(false);
    const [individualMargin, setIndividualMargin] = useState(false);
    const [individualBorderRadius, setIndividualBorderRadius] = useState(false);

    const blockProps = useBlockProps({
        style: {
            width,
            backgroundColor,
            color: textColor,
            padding: individualPadding ? `${paddingTop}px ${paddingRight}px ${paddingBottom}px ${paddingLeft}px` : `${padding}px`,
            margin: individualMargin ? `${marginTop}px ${marginRight}px ${marginBottom}px ${marginLeft}px` : `${margin}px`,
            fontSize: `${fontSize}px`,
            borderRadius: individualBorderRadius ? `${borderRadiusTopLeft}px ${borderRadiusTopRight}px ${borderRadiusBottomRight}px ${borderRadiusBottomLeft}px` : `${borderRadius}px`,
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            minHeight: '3rem'
        },
    });

    return (
        <>
            <InspectorControls>
            <PanelBody title={__('Button Settings', 'trademate')} initialOpen={true}>
                        <TextControl
                            label={__('Button Label', 'trademate')}
                            value={label}
                            onChange={(value) => setAttributes({ label: value })}
                        />
                        <div style={{ marginBottom: '10px' }}>
                            <strong>{__('Button Width', 'trademate')}</strong>
                        </div>
                        <ButtonGroup className="button-width-group">
                            {['25%', '50%', '75%', '100%'].map((size) => (
                                <Button
                                    key={size}
                                    variant={width === size ? 'primary' : 'secondary'}
                                    onClick={() => setAttributes({ width: size })}
                                >
                                    {size}
                                </Button>
                            ))}
                        </ButtonGroup>
                        <div style={{ marginTop: '10px' }}>
                            <RangeControl
                                label={__('Font Size', 'trademate')}
                                value={fontSize}
                                onChange={(value) => setAttributes({ fontSize: value })}
                                min={10}
                                max={40}
                            />
                        </div>
                    </PanelBody>

                    <PanelBody title={__('Padding Settings', 'trademate')} initialOpen={false}>
                        <ToggleControl
                            label={__('Individual Padding Control')}
                            checked={individualPadding}
                            onChange={() => setIndividualPadding(!individualPadding)}
                        />
                        {individualPadding ? (
                            <>
                                <RangeControl label={__('Padding Top', 'trademate')} value={paddingTop} onChange={(value) => setAttributes({ paddingTop: value })} min={0} max={50} />
                                <RangeControl label={__('Padding Right', 'trademate')} value={paddingRight} onChange={(value) => setAttributes({ paddingRight: value })} min={0} max={50} />
                                <RangeControl label={__('Padding Bottom', 'trademate')} value={paddingBottom} onChange={(value) => setAttributes({ paddingBottom: value })} min={0} max={50} />
                                <RangeControl label={__('Padding Left', 'trademate')} value={paddingLeft} onChange={(value) => setAttributes({ paddingLeft: value })} min={0} max={50} />
                            </>
                        ) : (
                            <RangeControl label={__('Padding', 'trademate')} value={padding} onChange={(value) => setAttributes({ padding: value })} min={0} max={50} />
                        )}
                    </PanelBody>

                    <PanelBody title={__('Margin Settings', 'trademate')} initialOpen={false}>
                        <ToggleControl
                            label={__('Individual Margin Control')}
                            checked={individualMargin}
                            onChange={() => setIndividualMargin(!individualMargin)}
                        />
                        {individualMargin ? (
                            <>
                                <RangeControl label={__('Margin Top', 'trademate')} value={marginTop} onChange={(value) => setAttributes({ marginTop: value })} min={0} max={50} />
                                <RangeControl label={__('Margin Right', 'trademate')} value={marginRight} onChange={(value) => setAttributes({ marginRight: value })} min={0} max={50} />
                                <RangeControl label={__('Margin Bottom', 'trademate')} value={marginBottom} onChange={(value) => setAttributes({ marginBottom: value })} min={0} max={50} />
                                <RangeControl label={__('Margin Left', 'trademate')} value={marginLeft} onChange={(value) => setAttributes({ marginLeft: value })} min={0} max={50} />
                            </>
                        ) : (
                            <RangeControl label={__('Margin', 'trademate')} value={margin} onChange={(value) => setAttributes({ margin: value })} min={0} max={50} />
                        )}
                    </PanelBody>

                    <PanelBody title={__('Border Radius Settings', 'trademate')} initialOpen={false}>
                        <ToggleControl
                            label={__('Individual Border Radius Control')}
                            checked={individualBorderRadius}
                            onChange={() => setIndividualBorderRadius(!individualBorderRadius)}
                        />
                        {individualBorderRadius ? (
                            <>
                                <RangeControl label={__('Top Left Radius', 'trademate')} value={borderRadiusTopLeft} onChange={(value) => setAttributes({ borderRadiusTopLeft: value })} min={0} max={50} />
                                <RangeControl label={__('Top Right Radius', 'trademate')} value={borderRadiusTopRight} onChange={(value) => setAttributes({ borderRadiusTopRight: value })} min={0} max={50} />
                                <RangeControl label={__('Bottom Right Radius', 'trademate')} value={borderRadiusBottomRight} onChange={(value) => setAttributes({ borderRadiusBottomRight: value })} min={0} max={50} />
                                <RangeControl label={__('Bottom Left Radius', 'trademate')} value={borderRadiusBottomLeft} onChange={(value) => setAttributes({ borderRadiusBottomLeft: value })} min={0} max={50} />
                            </>
                        ) : (
                            <RangeControl label={__('Border Radius', 'trademate')} value={borderRadius} onChange={(value) => setAttributes({ borderRadius: value })} min={0} max={50} />
                        )}
                    </PanelBody>

                    <PanelColorSettings
                        title={__('Color Settings', 'trademate')}
                        initialOpen={false}
                        colorSettings={[
                            {
                                value: backgroundColor,
                                onChange: (color) => setAttributes({ backgroundColor: color }),
                                label: __('Background Color', 'trademate'),
                            },
                            {
                                value: textColor,
                                onChange: (color) => setAttributes({ textColor: color }),
                                label: __('Text Color', 'trademate'),
                            },
                        ]}
                    />
            </InspectorControls>
            <Button {...blockProps} variant="primary">
                {label}
            </Button>
        </>
    );
};

export default Edit;