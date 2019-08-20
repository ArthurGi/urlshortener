import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import LinkTable from './LinkTable';
import StoreForm from './StoreForm';

export default class Main extends Component {
    constructor() {
        super();
        this.state = {
            links: [],
            changed : 0,
            errors : false,
        };
        this.handleStoreLink = this.handleStoreLink.bind(this)

    }
    handleStoreLink(link) {
        fetch('/api/store-link', {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': window.token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                'url' : link.url
            })
        })
            .then(response => {
                if (response.status === 201) {
                    this.setState({changed: this.state.changed + 1});
                }
                console.log('response', response);
                return response.json();
            })
            .then(data => {
                if(data.errors){
                    this.setState({errors: data.errors});
                } else {
                    this.setState({errors: false});
                }

            })

    }

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-12">
                        <div className="panel panel-default">
                            <div className="panel-heading">UrlShortener</div>
                            <div className="panel-body">
                                <StoreForm onStore={this.handleStoreLink} errors={this.state.errors}/>
                                <LinkTable changed={this.state.changed}/>
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
