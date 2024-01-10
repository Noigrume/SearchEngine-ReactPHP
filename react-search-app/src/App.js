import axios from "axios";
import React, { useState } from "react";
import SearchBar from "./components/SearchBar";
import ProductList from "./components/ProductList";
import "./App.css";

function App() {
  const [products, setProducts] = useState([]);

  const handleSearch = async (query) => {
    try {
      const response = await axios.get(
        `http://localhost/SearchEngine-ReactPHP/search-api/www/search?query=${query}`
      );
      console.log(response.data);
      setProducts(response.data);
    } catch (error) {
      console.error("Error fetching products:", error);
    }
  };

  return (
    <div>
      <div class="product-header"></div>
      <SearchBar onSearch={handleSearch} />
      <ProductList products={products} />
    </div>
  );
}

export default App;
