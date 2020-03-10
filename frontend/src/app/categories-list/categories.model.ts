
export interface Self {
  href: string;
}

export interface Next {
  href: string;
}

export interface Last {
  href: string;
}

export interface Links {
  self: Self;
  next: Next;
  last: Last;
}

export interface CreatedAt {
  date: string;
  timezone_type: number;
  timezone: string;
}

export interface UpdatedAt {
  date: string;
  timezone_type: number;
  timezone: string;
}

export interface Self2 {
  href: string;
}

export interface Links2 {
  self: Self2;
}

export interface Category {
  id: number;
  category: string;
  description: string;
  createdAt: CreatedAt;
  updatedAt: UpdatedAt;
  _links: Links2;
}

export interface Embedded {
  category: Category[];
}

export interface ResponseCategories {
  _total_items: number;
  _page: number;
  _page_count: number;
  _links: Links;
  _embedded: Embedded;
}

export interface RequestCreate {
  category: string;
  description: string;
}

export interface ResponseCreate {
  id: number;
  category: string;
  description: string;
  createdAt: CreatedAt;
  updatedAt: UpdatedAt;
  _links: Links2;
}
