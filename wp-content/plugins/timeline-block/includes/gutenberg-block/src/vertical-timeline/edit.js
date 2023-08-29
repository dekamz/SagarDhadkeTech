const { __ } = wp.i18n; // Import __() from wp.i18n
const { Component, Fragment,useState  } = wp.element;
const { RichText, InspectorControls, PanelColorSettings,MediaUpload } = wp.blockEditor;
const { RangeControl, PanelBody, CheckboxControl,Button,RadioControl } = wp.components;
import { defaultItem, getStyles } from './block';
import { InspectorContainer, ContainerEdit } from '../components/container/container';
import { Plus } from '../components/icons/plus';
import {SortableContainer, SortableElement} from 'react-sortable-hoc';
// import {SortableContainer, SortableElement} from 'react-sortable-hoc';
import arrayMove from 'array-move';
let key = 0;
/**
 * @param {Object} props - attributes
 * @returns {Node} rendered component
 */
export default class Edit extends Component {
    state = {
        activeSubBlock: -1,
    };

    /**
     * Add a new item to list with default fields
     */
    addItem = () => {
        key++;
        this.props.setAttributes( {
            items: [ ...this.props.attributes.items, {
                ...defaultItem,
            //    title: defaultItem.title + ' ' + ( key ),
                key: 'new ' + new Date().getTime(),
            } ],
        } );
    };

    /**
     * Change any property of item
     * @param {string} property - editable field
     * @param {string} value - for field
     * @param {number} index - of items array
     * @param {boolean} withMutation - in some cases we should avoid mutation for force rerender component
     */
    onChangePropertyItem = ( property, value, index, withMutation = false ) => {
        const items = withMutation ? [ ...this.props.attributes.items ] : this.props.attributes.items;
        if ( ! items[ index ] || typeof items[ index ][ property ] !== 'string' ) {
            return;
        }
        items[ index ][ property ] = value;
        this.props.setAttributes( { items: items } );
        wp.data.dispatch('core/editor').editPost({meta: {_non_existing_meta: true}});
    };

    onChangeImgItem = ( property, value, index, withMutation = false ) => {
        const items = withMutation ? [ ...this.props.attributes.items ] : this.props.attributes.items;
        if ( ! items[ index ] || typeof items[ index ][ property ] !== 'string' ) {
            return;
        }
        if(value.url!==undefined){
        items[ index ][ property ] = value.url;
        }else{
            items[ index ][ property ] =value;
        }
        if(value.alt!==undefined){
            items[ index ]['alt'] =value.alt;
        }
      this.props.setAttributes( { items: items } );
    //  debugger
    };
    /**
     * Remove item
     * It also add default item if we remove all elements from array
     * @param {number} index - of item
     */
    removeItem = ( index ) => {
        const items = [ ...this.props.attributes.items ];
        if ( items.length === 1 ) {
            this.props.setAttributes( { items: [ defaultItem ] } );
        } else {
            items.splice( index, 1 );
            this.props.setAttributes( { items: items } );
        }
    };
    render() {
        const Lists = () => {
            const [listData, setListData] = useState([
            ]);
        const SortableItem = SortableElement(({ value, yourIndex }) => (
            <div
                key={ value.key }
                className="timeline-content"
                data-order={yourIndex}
                id={yourIndex}
            >
            <button className="remove dashicons dashicons-no" onClick={ () => this.removeItem( yourIndex ) }>
               
            </button>
            <div className="moveicons" />
            { ( yourIndex + 1 ) % 2 !== 0 ? (
                    <div className="ctl-row">
                        { storyTime( value, yourIndex ) }
                        { storyDetails( value, yourIndex ) }
                    </div>
            ) : (
                    <div className="ctl-row">
                        { storyDetails( value, yourIndex ) }
                        { storyTime( value, yourIndex ) }
                    </div>
                ) 
            }
            </div>
        ));
        const SortableList = SortableContainer(({ items }) => {
            return (
            <div className="list">
                {items
                  .sort((a, b) => a.position - b.position)
                  .map((value, index) => (
                    <SortableItem  key={value.id} index={index} value={value} yourIndex={index} />
                  ))}
                </div>
            );
        });
        const onSortEnd = ({ oldIndex, newIndex }) => {
              let arr = arrayMove(attributes.items, oldIndex, newIndex);
              for (let i = 0; i < arr.length; i++) {
                arr[i].position = i;
              }
              setListData(arr);
              wp.data.dispatch('core/editor').editPost({meta: {_non_existing_meta: true}});
        };
        return (
              <Fragment>
                  {/* {console.log(attributes.items)} */}
                  <SortableList items={attributes.items} helperClass={'gctl-helper-class'} onSortEnd={onSortEnd} distance={2} disableAutoscroll={true}/>
                {/* <div className="list">{myList}</div> */}
              </Fragment>
        );
        };
        const {
            className,
            attributes,
            setAttributes,
            isSelected,
        } = this.props;
        const { otherStyles, wrapperStyles } = getStyles( attributes );
        const storyTime = ( item, index ) => (
            <div className="ctl-col-6">
                <div className="story-time">
                    <RichText
                        tagName="p"
                        placeholder={ __( 'Date / Custom Text', 'timeline-block' ) }
                        value={ item.time }
                        keepPlaceholderOnFocus={true}
                        onChange={ ( value ) => this.onChangePropertyItem( 'time', value, index, false ) }
                        style={ {
                            color:attributes.textColor,
                        //    color: item.storyTextColor,
                            fontSize: `${ attributes.timeSize }px`,
                        } }
                    />
                </div>
            </div>
        );

        const storyDetails = ( item, index ) => (
            <div className="ctl-col-6">
                 <div className="story-details"  style={ {
                              color:attributes.textColor,
                          //  backgroundColor:item.storyBgColor,
                           // color:item.storyTextColor
                        } }>
                 <div className="ctl-story-img backend">
                    <MediaUpload
                        onSelect={ ( value ) => this.onChangeImgItem( 'storyImage',value, index, true ) }
                        value={ item.storyImage }
                        alt={item.alt}
                        allowedTypes={ [ 'image' ] }
                        render={ ( mediaUploadProps ) => (
                            <Fragment>
                                  { ( item.storyImage !== 'none' ) &&
                                    <Fragment>
                                        <img src={item.storyImage} alt={item.alt} />
                                        <Button
                                            isSecondary 
                                            onClick={ ( value ) => this.onChangeImgItem( 'storyImage','none', index, true ) }
                                        >
                                            { __( 'Remove Image', 'timeline-block' ) }
                                
                                        </Button>
                                      
                                    </Fragment>
                                  }
                                 { ( item.storyImage == 'none' )   &&
                              
                                    <Button isSecondary onClick={ mediaUploadProps.open }>
                                        { __( 'Upload/Choose Image', 'timeline-block' ) }
                                    </Button>
                                 }
                            </Fragment>
                            ) }
                        />
                    </div>
                  
                   
                    <RichText
                        tagName="h3"
                        placeholder={ __( 'Enter Story Title', 'timeline-block' ) }
                        value={ item.title }
                        keepPlaceholderOnFocus={true}
                        onChange={ ( value ) => this.onChangePropertyItem( 'title', value, index, false ) }
                        style={ {
                            color:attributes.textColor,
                           // color:item.storyTextColor,
                            fontSize: `${ attributes.titleSize }px`,
                            lineHeight: `${ attributes.titleSize * 1.34 }px`,
                        } }
                    />
                    <RichText
                        tagName="p"
                        placeholder={ __( 'Enter story description here.', 'timeline-block' ) }
                        value={ item.description }
                        keepPlaceholderOnFocus={true}
                        onChange={ ( value ) => this.onChangePropertyItem( 'description', value, index, false ) }
                        style={ {
                            color:attributes.textColor,
                           // color: item.storyTextColor,
                            fontSize: `${ attributes.descriptionSize }px`,
                            lineHeight: `${ attributes.descriptionSize * 1.73 }px`,
                        } }
                    />
                </div>
            </div>
        );
                  
        return (
            <div>
                <InspectorControls>
                    <PanelBody
                        title={ __( 'General Settings', 'timeline-block' ) }
                        initialOpen={ false }
                    >
                        <RadioControl
                            label={ __( 'Timeline Layout', 'timeline-block' ) }
                            selected={ attributes.timelineLayout }
                            options={ [
                                { label: 'Default (Both Sided)', value: 'both-sided' },
                                { label: 'One Sided', value: 'one-sided' },
                            ] }
                            onChange={ ( value ) => {
                                setAttributes( { timelineLayout: value } );
                            } }
                            help={ __( 'Vertical Timeline Layouts', 'timeline-block' ) }
                        />
                        <RangeControl
                            label={ __( 'Title Size', 'timeline-block' ) }
                            value={ attributes.titleSize }
                            onChange={ ( titleSize ) => setAttributes( { titleSize } ) }
                            min={ 10 }
                            max={ 130 }
                        />
                        <RangeControl
                            label={ __( 'Description Size', 'timeline-block' ) }
                            value={ attributes.descriptionSize }
                            onChange={ ( descriptionSize ) => setAttributes( { descriptionSize } ) }
                            min={ 10 }
                            max={ 130 }
                        />
                        <RangeControl
                            label={ __( 'Date / Time Size', 'timeline-block' ) }
                            value={ attributes.timeSize }
                            onChange={ ( timeSize ) => setAttributes( { timeSize } ) }
                            min={ 10 }
                            max={ 130 }
                        />
                        <PanelColorSettings
                            title={ __( 'Colors', 'timeline-block' ) }
                            initialOpen={ false }
                            colorSettings={ [
                                {
                                    value: attributes.textColor,
                                    onChange: ( value ) => {
                                        return setAttributes( { textColor: value } );
                                    },
                                    label: __( 'Text Color', 'timeline-block' ),
                                },
                                {
                                    value: attributes.timeLineColor,
                                    onChange: ( timeLineColor ) => {
                                        return setAttributes( { timeLineColor } );
                                    },
                                    label: __( 'Line / Circle Color', 'timeline-block' ),
                                },
                            ] }
                        />
                          
                    </PanelBody>
                    <InspectorContainer
                        setAttributes={ setAttributes }
                        { ...attributes }
                      
                    />
                </InspectorControls>
                <div className={ className ? className : '' } style={ otherStyles }>
                    <ContainerEdit
                        className={ `ctl-instant-timeline block-${ attributes.blockUniqId } ${ isSelected ? 'selected' : '' } ` }
                        attributes={ attributes }
                    >
                    <Lists />
                    <div className="editPadding" />
                        <button
                            className="addWhite"
                            onClick={ this.addItem }>
                            <span><Plus /></span>{ __( 'Add New Story', 'timeline-block' ) }
                        </button>
                    </ContainerEdit>
                </div>
            </div>
        );
    }
}
