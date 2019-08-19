import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import LinkTable from './LinkTable';
import StoreForm from './StoreForm';

export default class Main extends Component {
    constructor() {

        super();

        /* currentProduct keeps track of the product currently
         * displayed */
        this.state = {
            products: [],
            currentProduct: null
        }
    }
    handleStoreLink(link) {

        fetch('api/store-link/', {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': window.token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(link)
        })
            .then(response => {
                return response.json();
            })
            // .then(data => {
            //
            //     this.setState((prevState) => ({
            //         links: prevState.links.concat(data),
            //         currentLink: data
            //     }))
            // })

    }

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-12">
                        <div className="panel panel-default">
                            <div className="panel-heading">UrlShortener</div>
                            <div className="panel-body">
                                <StoreForm onStore={this.handleStoreLink}/>
                                <LinkTable/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}


if (document.getElementById('root')) {
    ReactDOM.render(<Main/>, document.getElementById('root'));
}
