import React, {Component} from 'react';


class LinkTable extends Component {
    constructor() {

        super();
        this.state = {
            links: [],
        }
    }

    componentDidMount() {
        fetch('/api/get-links')
            .then(response => {
                return response.json();
            })
            .then(links => {
                this.setState({links});
            });
    }

    renderLinks() {
        return this.state.links.map(link => {
            return (
                <tr key={link.id}>
                    <td>{link.url}</td>
                    <td><a href={'/' + link.alias + '/'}
                           target="_blank">{'/' + link.alias + '/'}</a></td>
                </tr>
            );
        });
    }

    render() {
        return (
            <table className="table table-bordered table-sm">
                <thead>
                <tr>
                    <th>Url</th>
                    <th>Alias</th>
                </tr>
                {this.renderLinks()}
                </thead>
                <tbody>
                </tbody>
            </table>
        );
    }
}


export default LinkTable;
