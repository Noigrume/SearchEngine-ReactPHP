import axios from 'axios';
import React, { useState } from 'react';
import SearchBar from './SearchBar';
import ProductList from './ProductList';
import './App.css';
function App() {
    const [products, setProducts] = useState([]);

    const handleSearch = async (query) => {
        try {
            const response = await axios.get(`http://localhost/SearchEngine-ReactPHP/search-api/www/search?query=${query}`);
            setProducts(response.data);
        } catch (error) {
            console.error('Error fetching products:', error);
        }
    };
        
    return (
        <div>
            <SearchBar onSearch={handleSearch} />
            <ProductList products={products} />
        </div>
    );
}

export default App;
